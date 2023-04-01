<?php
namespace PHPMVC\Lib\Template;

class Template
{

    use TemplateHelper;

    private $_templateParts;
    private $_action_view;
    private $_data;

    private $_registry;

    public function __construct($parts)
    {
        $this->_templateParts = $parts;
    }

    // TODO: implement better solution
    public function swapTemplate($template): void
    {
        $this->_templateParts['template'] = $template;
    }

    public function setActionViewFile($actionViewPath): void
    {
        $this->_action_view = $actionViewPath;
    }

    public function setAppData($data): void
    {
        $this->_data = $data;
    }

    public function setRegistry($registry): void
    {
        $this->_registry = $registry;
    }

    public function __get($key): mixed
    {
        return $this->_registry->$key;
    }

    private function renderTemplateHeaderStart(): void
    {
        extract($this->_data);
        require_once TEMPLATE_PATH . 'templateheaderstart.php';
    }

    private function renderTemplateHeaderEnd(): void
    {
        extract($this->_data);
        require_once TEMPLATE_PATH . 'templateheaderend.php';
    }

    private function renderTemplateFooter(): void
    {
        extract($this->_data);
        require_once TEMPLATE_PATH . 'templatefooter.php';
    }

    private function renderTemplateBlocks(): void
    {
        if(!array_key_exists('template', $this->_templateParts)){
            trigger_error('Sorry you have to define template blocks', E_USER_WARNING);
        } else {
            $parts = $this->_templateParts['template'];
            if(!empty($parts)){
                extract($this->_data);
                foreach($parts as $partKey => $file){
                    if($partKey === ':view'){
                        require_once $this->_action_view;
                    } else {
                        require_once $file;
                    }
                }
            }
            
        }
    }

    private function renderHeaderResources(): void
    {
        $output = '';
        if(!array_key_exists('header_resources', $this->_templateParts)){
            trigger_error('Sorry you have to define header resources', E_USER_WARNING);
        } else {
            $headers = $this->_templateParts['header_resources'];
            
            // Genrate CSS Links
            $css = $headers['css'];
            if(!empty($css)){
                foreach($css as $cssKey => $path){
                    if(str_contains($cssKey, 'pre'))
                    {
                        $output .= "\t" . '<link type="text/css" rel="preconnect" href="' . $path . '" />' . "\n";
                    }
                    
                    $output .= "\t" . '<link type="text/css" rel="stylesheet" href="' . $path . '" />' . "\n";
                }
            }

            // Genrate JS Scripts
            $js = $headers['js'];
            if(!empty($js)){
                foreach($js as $jsKey => $path){
                    $output .= "\t" . '<script type="javascript" src="' . $path . '"></script>' . "\n";
                }
            }
        }
        echo $output;
    }

    private function renderFooterResources(): void
    {
        $output = '';
        if(!array_key_exists('footer_resources', $this->_templateParts)){
            trigger_error('Sorry you have to define Footer resources', E_USER_WARNING);
        } else {
            $resources = $this->_templateParts['footer_resources'];

            // Genrate JS Scripts
            if(!empty($resources)){
                foreach($resources as $resourcesKey => $path){
                    $output .= "\t" . '<script src="' . $path . '"></script>' . "\n";
                }
            }
        }
        echo $output;
    }

    public function renderApp(): void
    {
        $this->renderTemplateHeaderStart();
        $this->renderHeaderResources();
        $this->renderTemplateHeaderEnd();
        $this->renderTemplateBlocks();
        // $this->renderFooterResources();
        $this->renderTemplateFooter();
    }
}