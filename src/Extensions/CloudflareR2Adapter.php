<?php

namespace Daugt\Extensions;

use Aws\S3\S3ClientInterface;
use League\Flysystem\AwsS3V3\AwsS3V3Adapter;
use League\Flysystem\AwsS3V3\PortableVisibilityConverter;
use League\Flysystem\AwsS3V3\VisibilityConverter;
use League\Flysystem\Config;
use League\Flysystem\PathPrefixer;
use League\MimeTypeDetection\FinfoMimeTypeDetector;
use League\MimeTypeDetection\MimeTypeDetector;

class CloudflareR2Adapter extends AwsS3V3Adapter
{

    // overriding the constructor is necessary for livewire to be able to "invade" the adapter and access the client because the invade function does not access the parent constructor
    public function __construct(
        private S3ClientInterface $client,
        private string $bucket
    ) {
        // call base constructor
        parent::__construct($client, $bucket, '', null, null, [], true, [], [], []);
    }


    public function move(string $source, string $destination, Config $config): void
    {
        // override visibility to prevent running into unsupported GetObjectACL
        $config = $config->extend(['visibility' => 'public']);
        parent::move($source, $destination, $config);
    }
}