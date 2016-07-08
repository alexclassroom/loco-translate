<?php
/**
 * Common controller for listing of all bundle types
 */
abstract class Loco_admin_list_BaseController extends Loco_mvc_AdminController {
    
    private $bundles = array();


    /**
     * build renderable bundle variables
     * @return Loco_mvc_ViewParams
     */
    protected function bundleParam( Loco_package_Bundle $bundle ){
        //$info = $bundle->getHeaderInfo();
        return new Loco_mvc_ViewParams( array (
            'id'   => $bundle->getId(),
            'name' => $bundle->getName(),
            'dflt' => ( $default = $bundle->getDefaultProject() ) ? $default->getDomain() : '--',
            'size' => count( $bundle ),
            'save' => $bundle->isConfigured(),
            'slug' => $slug = $bundle->getSlug(),
            'type' => $type = strtolower( $bundle->getType() ),
            'view' => Loco_mvc_AdminRouter::generate( $type.'-view', array( 'bundle' => $slug ) ),
            'conf' => Loco_mvc_AdminRouter::generate( $type.'-conf', array( 'bundle' => $slug ) ),
        ) );
    }
    

    /**
     * Add bundle to enabled or disabled list, depending on whether it is configured
     */
    protected function addBundle( Loco_package_Bundle $bundle ){
        $this->bundles[] = $this->bundleParam($bundle);
    }
    


    public function render(){

        // breadcrumb is just the root
        $here = new Loco_admin_Navigation( array (
            new Loco_mvc_ViewParams( array( 'name' => $this->get('title') ) ),
        ) );
        
        /*/ tab between the types of bundles
        $types = array (
            '' => __('Home','loco'),
            'theme'  => __('Themes','loco'),
            'plugin' => __('Plugins','loco'),
        );
        $current = $this->get('_route');
        $tabs = new Loco_admin_Navigation;
        foreach( $types as $type => $name ){
            $href = Loco_mvc_AdminRouter::generate($type);
            $tabs->add( $name, $href, $type === $current );
        }
        */
                
        return $this->view( 'admin/list/bundles', array (
            'bundles' => $this->bundles,
            'breadcrumb' => $here,
        ) );
    }

    
}