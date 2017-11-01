<?php
namespace App\MyLibrary;

use Jaybizzle\CrawlerDetect\CrawlerDetect;

class HandleCrawlers{

    public function detect_crawler(){
       $CrawlerDetect = new CrawlerDetect;
       // Check the user agent of the current 'visitor'
       if($CrawlerDetect->isCrawler()) {
	         // true if crawler user agent detected
             return true;
          }

          return false;
    }

}