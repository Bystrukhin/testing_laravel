<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\BladeDirective;
use App\RussianCache;

class ExampleTest extends TestCase
{

    public function testNormalizeStringForCacheKey()
    {

        $cache = $this->prophesize(RussianCache::class);

        $directive = new BladeDirective($cache->reveal());

        $cache->has('cache-key')->shouldBeCalled();

        $directive->setUp('cache-key');

    }

    public function testNormalizeCacheableModelForCacheKey()
    {

        $cache = $this->prophesize(RussianCache::class);

        $directive = new BladeDirective($cache->reveal());

        $cache->has('stub-cache-key')->shouldBeCalled();

        $directive->setUp(new ModelStub);

    }

    public function testNormalizeArrayForCacheKey()
    {

        $cache = $this->prophesize(RussianCache::class);

        $directive = new BladeDirective($cache->reveal());

        $item = ['foo', 'bar'];

        $cache->has(md5('foobar'))->shouldBeCalled();

        $directive->setUp($item);

    }
}


class ModelStub
{

    public function getCacheKey()
    {

        return 'stub-cache-key';

    }

}