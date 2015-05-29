<?php
namespace CB\UNITTESTS;

/**
 * Description of SearchTest
 *
 * @author ghindows
 */
class SearchTest extends \PHPUnit_Framework_TestCase
{

    
    public function SearchDataProvider()
    {
        return \CB\UNITTESTS\DATA\get_basic_search_data();
    }
    /**
     * @dataProvider SearchDataProvider
     */
    public function testSearch($search)
    {
       $src = new \CB\Search();
       $this->assertTrue($src->ping()>0);
       $src_response = $src->search('test',0,10,[]);
       $this->assertEquals('OK',$src_response->getHttpStatusMessage(), $src_response->getHttpStatusMessage() );
       $result = \CB\UNITTESTS\HELPERS\get_include_contents(\CB\DOC_ROOT.'remote/router.php', [ 'postdata' => $search['postdata']]);
       $this->assertArraySubset(json_decode($search['expected_response'], true), json_decode($result,true), $result);
       
    }

    public function testReindexSolr() {

        
        /*$argv[1] = '-c';
        $argv[2] = 'test';
        $argv[3] = '-a';
        $argv[4] = '-l'; */

        $content = \CB\UNITTESTS\HELPERS\get_include_contents(\CB\BIN_DIR. 'solr_reindex_core.php');

        $this->assertEquals('no core specified or invalid options set.',$content);
     
    }

}