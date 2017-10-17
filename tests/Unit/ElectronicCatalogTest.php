<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Classes\Core\ElectronicCatalog;
use App\Classes\Core\ElectronicItem;
use App\Classes\Core\ElectronicSpecification;

class ElectronicCatalogTest extends TestCase
{
  public function testSetTest(){

    $electronicSpecification = new ElectronicSpecification();
    $electronicItem1 = new ElectronicItem();
    $electronicItem2 = new ElectronicItem();

    $item1Data=new \stdClass();
    $item1Data->id="abc123";
    $item1Data->serialNumber=123;
    $item1Data->ElectronicSpecification_id="123abc";

    $item2Data=new \stdClass();
    $item2Data->id="abc456";
    $item2Data->serialNumber=456;
    $item2Data->ElectronicSpecification_id="456abc";
    $electronicItem1->set($item1Data);
    $electronicItem2->set($item2Data);
    $electronicItems=array($electronicItem1,$electronicItem2);

    $electronicData= new \stdClass();

    $electronicData->id = '1';
    $electronicData->dimension = '2X3X4';
    $electronicData->weight = '100';
    $electronicData->modelNumber = '123';
    $electronicData->brandName = '123';
    $electronicData->hdSize = '123';
    $electronicData->price = '123';
    $electronicData->processorType = 'intel';
    $electronicData->ramSize = '16';
    $electronicData->cpuCores = '4';
    $electronicData->batteryInfo = 'infinite';
    $electronicData->os = 'ubuntu';
    $electronicData->camera = true;
    $electronicData->touchScreen = true;
    $electronicData->ElectronicType_id = '1';
    $electronicData->displaySize = '1';
    $electronicData->electronicItems = $electronicItems;

    $electronicSpecification->set($electronicData);

    $electronicCatalog = new ElectronicCatalog();
    $electronicCatalog->setESList(array($electronicData));
    $catalogList = $electronicCatalog->getESList();
    $this->assertTrue(sizeof($catalogList)==sizeof(array($electronicData)));
    }
  }
