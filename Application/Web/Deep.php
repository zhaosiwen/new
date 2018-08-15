<?php
/**
 * Cookbook
 * 
 * A private application software for php
 * 
 * @package Cookbook
 * @author siwen.zhao<1559617934@qq.com>
 * @license http://xxx
 * @link http://xxx/ss
 * @version 1.0
 * @since 1.0
 */
namespace Application\Web;

/**
 * Deep
 * 
 * Deep scan web page
 * 
 * @category Web
 * @author siwen.zhao<1559617934@qq.com>
 * @link http://xxxx/web
 */
class Deep
{
    /**
     * Domain
     * 
     * @var string
     */
    protected $domain;
    
    /**
     * Scan page
     * 
     * Get all the tags in the scan list
     * @param string $url
     * @param string $tag
     * @return integer
     */
    public function scan($url, $tag)
    {
        $vac = new Hoover();
        $scan = $vac->getAttribute($url, 'href', $this->getDomain($url));
        $result = array();
        foreach ($scan as $subSite) {
            yield from $vac->getTags($subSite, $tag);
        }
            return count($scan);
    }
    
    /**
     * Get domain
     * 
     * Get the domain name through the url
     * 
     * @param string $url
     * @return string
     */
    public function getDomain($url)
    {
        if (!$this->domain) {
            $this->domain = parse_url($url, PHP_URL_HOST);
        }
        return $this->domain;
    }
    
}