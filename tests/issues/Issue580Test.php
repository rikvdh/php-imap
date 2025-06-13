<?php

namespace Tests\issues;

use PHPUnit\Framework\TestCase;
use Tests\fixtures\FixtureTestCase;
use Webklex\PHPIMAP\Attachment;
use Webklex\PHPIMAP\ClientManager;
use Webklex\PHPIMAP\Exceptions\AuthFailedException;
use Webklex\PHPIMAP\Exceptions\ConnectionFailedException;
use Webklex\PHPIMAP\Exceptions\ImapBadRequestException;
use Webklex\PHPIMAP\Exceptions\ImapServerErrorException;
use Webklex\PHPIMAP\Exceptions\InvalidMessageDateException;
use Webklex\PHPIMAP\Exceptions\MaskNotFoundException;
use Webklex\PHPIMAP\Exceptions\MessageContentFetchingException;
use Webklex\PHPIMAP\Exceptions\ResponseException;
use Webklex\PHPIMAP\Exceptions\RuntimeException;

class Issue580Test extends FixtureTestCase {

    /**
     * @throws RuntimeException
     * @throws MessageContentFetchingException
     * @throws ResponseException
     * @throws ImapBadRequestException
     * @throws InvalidMessageDateException
     * @throws ConnectionFailedException
     * @throws \ReflectionException
     * @throws ImapServerErrorException
     * @throws AuthFailedException
     * @throws MaskNotFoundException
     */
    public function testIssueEmail() {
        $message = $this->getFixture("issue-580.eml");

        self::assertSame("html body in multipart related container is parsed as attachment", (string)$message->subject);

        self::assertStringContainsString('This is a message in a multipart related container', $message->getHTMLBody());

        $attachments = $message->getAttachments();
        self::assertSame(0, $attachments->count());
    }
}