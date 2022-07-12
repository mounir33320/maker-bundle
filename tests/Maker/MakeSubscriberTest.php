<?php

/*
 * This file is part of the Symfony MakerBundle package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Bundle\MakerBundle\Tests\Maker;

use Symfony\Bundle\MakerBundle\Maker\MakeSubscriber;
use Symfony\Bundle\MakerBundle\Test\MakerTestCase;
use Symfony\Bundle\MakerBundle\Test\MakerTestRunner;

class MakeSubscriberTest extends MakerTestCase
{
    protected function getMakerClass(): string
    {
        return MakeSubscriber::class;
    }

    public function getTestDetails(): \Generator
    {
        yield 'it_makes_subscriber_for_known_event' => [$this->createMakerTest()
            ->run(function (MakerTestRunner $runner) {
                $runner->runMaker(
                    [
                        // subscriber name
                        'FooBar',
                        // event name
                        'kernel.request',
                    ]
                );
            }),
        ];

        yield 'it_makes_subscriber_for_unknown_event_class' => [$this->createMakerTest()
            ->run(function (MakerTestRunner $runner) {
                $runner->runMaker(
                    [
                        // subscriber name
                        'FooBar',
                        // event name
                        'foo.unknown_event',
                    ]
                );
            }),
        ];
    }
}
