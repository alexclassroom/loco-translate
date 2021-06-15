<?php
/**
 * Abstracts PO sync options held in custom headers
 */
class Loco_gettext_SyncOptions {

    /**
     * @var LocoPoHeaders
     */
    private $head;


    public function __construct( LocoPoHeaders $head ){
        $this->head = $head;
    }


    /**
     * Test if PO file has alternative template path
     * @return bool
     */
    public function hasTemplate(){
        return $this->head->has('X-Loco-Template');
    }


    /**
     * Get *relative* path to alternative template path.
     * @return Loco_fs_File
     */
    public function getTemplate(){
        return new Loco_fs_File( $this->head['X-Loco-Template'] );
    }


    /**
     * Set *relative* path to alternative template path. 
     * @param string
     */
    public function setTemplate( $path ){
        $this->head['X-Loco-Template'] = (string) $path;
    }


    /**
     * Test if translations (msgstr fields) are to be merged.
     * Default sync behaviour is to copy msgstr fields unless *explicitly* in POT mode
     * @return bool
     */
    public function mergeMsgstr(){
        return 0 === preg_match( '/\\bpot\\b/', $this->getSyncMode() );
    }


    /**
     * Test if JSON files are merged.
     * @return bool
     */
    public function mergeJson(){
        return 1 === preg_match( '/\\bjson\\b/', $this->getSyncMode() );
    }


    /**
     * @return string
     */
    public function getSyncMode(){
        return strtolower( $this->head->trimmed('X-Loco-Template-Mode') );
    }


    /**
     * @param string
     */
    public function setSyncMode( $mode ){
        $this->head['X-Loco-Template-Mode'] = (string) $mode;
    }
    

}
