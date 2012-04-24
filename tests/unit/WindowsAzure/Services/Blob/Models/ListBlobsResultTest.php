<?php

/**
 * LICENSE: Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 * PHP version 5
 *
 * @category  Microsoft
 * @package   Tests\Unit\WindowsAzure\Services\Blob\Models
 * @author    Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
namespace Tests\Unit\WindowsAzure\Services\Blob\Models;
use WindowsAzure\Services\Blob\Models\ListBlobsResult;
use Tests\Framework\TestResources;

/**
 * Unit tests for class ListBlobsResult
 *
 * @category  Microsoft
 * @package   Tests\Unit\WindowsAzure\Services\Blob\Models
 * @author    Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
class ListBlobsResultTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers WindowsAzure\Services\Blob\Models\ListBlobsResult::create 
     */
    public function testCreateWithEmpty()
    {
        // Setup
        $sample = TestResources::listBlobsEmpty();
        
        // Test
        $actual = ListBlobsResult::create($sample);
        
        // Assert
        $this->assertCount(0, $actual->getBlobs());
        $this->assertCount(0, $actual->getBlobPrefixes());
        $this->assertEquals(0,$actual->getMaxResults());
    }
    
    /**
     * @covers WindowsAzure\Services\Blob\Models\ListBlobsResult::create 
     */
    public function testCreateWithOneEntry()
    {
        // Setup
        $sample = TestResources::listBlobsOneEntry();
        
        // Test
        $actual = ListBlobsResult::create($sample);
        
        // Assert
        $this->assertCount(1, $actual->getBlobs());
        $this->assertCount(1, $actual->getBlobPrefixes());
        $this->assertEquals($sample['Marker'], $actual->getMarker());
        $this->assertEquals(intval($sample['MaxResults']), $actual->getMaxResults());
        $this->assertEquals($sample['NextMarker'], $actual->getNextMarker());
        $this->assertEquals($sample['Delimiter'], $actual->getDelimiter());
        $this->assertEquals($sample['Prefix'], $actual->getPrefix());
    }
    
    /**
     * @covers WindowsAzure\Services\Blob\Models\ListBlobsResult::create 
     */
    public function testCreateWithMultipleEntries()
    {
        // Setup
        $sample = TestResources::listBlobsMultipleEntries();
        
        // Test
        $actual = ListBlobsResult::create($sample);
        
        // Assert
        $this->assertCount(2, $actual->getBlobs());
        $this->assertCount(2, $actual->getBlobPrefixes());
        $this->assertEquals($sample['Marker'], $actual->getMarker());
        $this->assertEquals(intval($sample['MaxResults']), $actual->getMaxResults());
        $this->assertEquals($sample['NextMarker'], $actual->getNextMarker());
        
        return $actual;
    }
    
    /**
     * @covers WindowsAzure\Services\Blob\Models\ListBlobsResult::getBlobPrefixes
     * @depends testCreateWithMultipleEntries
     */
    public function testGetBlobPrefixs($result)
    {
        // Test
        $actual = $result->getBlobPrefixes();
        
        // Assert
        $this->assertCount(2, $actual);
    }
    
    /**
     * @covers WindowsAzure\Services\Blob\Models\ListBlobsResult::setBlobPrefixes
     * @depends testCreateWithMultipleEntries
     */
    public function testSetBlobPrefixs($result)
    {
        // Setup
        $sample = new ListBlobsResult();
        $expected = $result->getBlobPrefixes();
        
        // Test
        $sample->setBlobPrefixes($expected);
        
        // Assert
        $this->assertEquals($expected, $sample->getBlobPrefixes());
        $expected[0]->setName('test');
        $this->assertNotEquals($expected, $sample->getBlobPrefixes());
    }
    
    /**
     * @covers WindowsAzure\Services\Blob\Models\ListBlobsResult::getBlobs
     * @depends testCreateWithMultipleEntries
     */
    public function testGetBlobs($result)
    {
        // Test
        $actual = $result->getBlobs();
        
        // Assert
        $this->assertCount(2, $actual);
    }
    
    /**
     * @covers WindowsAzure\Services\Blob\Models\ListBlobsResult::setBlobs
     * @depends testCreateWithMultipleEntries
     */
    public function testSetBlobs($result)
    {
        // Setup
        $sample = new ListBlobsResult();
        $expected = $result->getBlobs();
        
        // Test
        $sample->setBlobs($expected);
        
        // Assert
        $this->assertEquals($expected, $sample->getBlobs());
        $expected[0]->setName('test');
        $this->assertNotEquals($expected, $sample->getBlobs());
    }
    
    /**
     * @covers WindowsAzure\Services\Blob\Models\ListBlobsResult::setPrefix
     */
    public function testSetPrefix()
    {
        // Setup
        $options = new ListBlobsResult();
        $expected = 'myprefix';
        
        // Test
        $options->setPrefix($expected);
        
        // Assert
        $this->assertEquals($expected, $options->getPrefix());
    }
    
    /**
     * @covers WindowsAzure\Services\Blob\Models\ListBlobsResult::getPrefix
     */
    public function testGetPrefix()
    {
        // Setup
        $options = new ListBlobsResult();
        $expected = 'myprefix';
        $options->setPrefix($expected);
        
        // Test
        $actual = $options->getPrefix();
        
        // Assert
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @covers WindowsAzure\Services\Blob\Models\ListBlobsResult::setNextMarker
     */
    public function testSetNextMarker()
    {
        // Setup
        $options = new ListBlobsResult();
        $expected = 'mymarker';
        
        // Test
        $options->setNextMarker($expected);
        
        // Assert
        $this->assertEquals($expected, $options->getNextMarker());
    }
    
    /**
     * @covers WindowsAzure\Services\Blob\Models\ListBlobsResult::getNextMarker
     */
    public function testGetNextMarker()
    {
        // Setup
        $options = new ListBlobsResult();
        $expected = 'mymarker';
        $options->setNextMarker($expected);
        
        // Test
        $actual = $options->getNextMarker();
        
        // Assert
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @covers WindowsAzure\Services\Blob\Models\ListBlobsResult::setMarker
     */
    public function testSetMarker()
    {
        // Setup
        $options = new ListBlobsResult();
        $expected = 'mymarker';
        
        // Test
        $options->setMarker($expected);
        
        // Assert
        $this->assertEquals($expected, $options->getMarker());
    }
    
    /**
     * @covers WindowsAzure\Services\Blob\Models\ListBlobsResult::getMarker
     */
    public function testGetMarker()
    {
        // Setup
        $options = new ListBlobsResult();
        $expected = 'mymarker';
        $options->setMarker($expected);
        
        // Test
        $actual = $options->getMarker();
        
        // Assert
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @covers WindowsAzure\Services\Blob\Models\ListBlobsResult::setMaxResults
     */
    public function testSetMaxResults()
    {
        // Setup
        $options = new ListBlobsResult();
        $expected = 3;
        
        // Test
        $options->setMaxResults($expected);
        
        // Assert
        $this->assertEquals($expected, $options->getMaxResults());
    }
    
    /**
     * @covers WindowsAzure\Services\Blob\Models\ListBlobsResult::getMaxResults
     */
    public function testGetMaxResults()
    {
        // Setup
        $options = new ListBlobsResult();
        $expected = 3;
        $options->setMaxResults($expected);
        
        // Test
        $actual = $options->getMaxResults();
        
        // Assert
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @covers WindowsAzure\Services\Blob\Models\ListBlobsResult::setDelimiter
     */
    public function testSetDelimiter()
    {
        // Setup
        $options = new ListBlobsResult();
        $expected = 'mydelimiter';
        
        // Test
        $options->setDelimiter($expected);
        
        // Assert
        $this->assertEquals($expected, $options->getDelimiter());
    }
    
    /**
     * @covers WindowsAzure\Services\Blob\Models\ListBlobsResult::getDelimiter
     */
    public function testGetDelimiter()
    {
        // Setup
        $options = new ListBlobsResult();
        $expected = 'mydelimiter';
        $options->setDelimiter($expected);
        
        // Test
        $actual = $options->getDelimiter();
        
        // Assert
        $this->assertEquals($expected, $actual);
    }
}

?>
