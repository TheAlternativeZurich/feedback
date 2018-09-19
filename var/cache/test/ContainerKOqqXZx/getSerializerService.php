<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'serializer' shared service.

include_once $this->targetDirs[3].'/vendor/symfony/serializer/SerializerInterface.php';
include_once $this->targetDirs[3].'/vendor/symfony/serializer/Normalizer/NormalizerInterface.php';
include_once $this->targetDirs[3].'/vendor/symfony/serializer/Normalizer/ContextAwareNormalizerInterface.php';
include_once $this->targetDirs[3].'/vendor/symfony/serializer/Normalizer/DenormalizerInterface.php';
include_once $this->targetDirs[3].'/vendor/symfony/serializer/Normalizer/ContextAwareDenormalizerInterface.php';
include_once $this->targetDirs[3].'/vendor/symfony/serializer/Encoder/EncoderInterface.php';
include_once $this->targetDirs[3].'/vendor/symfony/serializer/Encoder/ContextAwareEncoderInterface.php';
include_once $this->targetDirs[3].'/vendor/symfony/serializer/Encoder/DecoderInterface.php';
include_once $this->targetDirs[3].'/vendor/symfony/serializer/Encoder/ContextAwareDecoderInterface.php';
include_once $this->targetDirs[3].'/vendor/symfony/serializer/Serializer.php';
include_once $this->targetDirs[3].'/vendor/symfony/serializer/Normalizer/NormalizerAwareInterface.php';
include_once $this->targetDirs[3].'/src/Normalizer/ArrayCollectionNormalizer.php';
include_once $this->targetDirs[3].'/src/Normalizer/DateTimeNormalizer.php';
include_once $this->targetDirs[3].'/vendor/symfony/serializer/SerializerAwareInterface.php';
include_once $this->targetDirs[3].'/vendor/symfony/serializer/Normalizer/CacheableSupportsMethodInterface.php';
include_once $this->targetDirs[3].'/vendor/symfony/serializer/Normalizer/ObjectToPopulateTrait.php';
include_once $this->targetDirs[3].'/vendor/symfony/serializer/SerializerAwareTrait.php';
include_once $this->targetDirs[3].'/vendor/symfony/serializer/Normalizer/AbstractNormalizer.php';
include_once $this->targetDirs[3].'/vendor/symfony/serializer/Normalizer/JsonSerializableNormalizer.php';
include_once $this->targetDirs[3].'/vendor/symfony/serializer/Normalizer/DateTimeNormalizer.php';
include_once $this->targetDirs[3].'/vendor/symfony/serializer/Normalizer/ConstraintViolationListNormalizer.php';
include_once $this->targetDirs[3].'/vendor/symfony/serializer/Normalizer/DateIntervalNormalizer.php';
include_once $this->targetDirs[3].'/vendor/symfony/serializer/Normalizer/DataUriNormalizer.php';
include_once $this->targetDirs[3].'/vendor/symfony/serializer/Normalizer/ArrayDenormalizer.php';
include_once $this->targetDirs[3].'/vendor/symfony/serializer/Encoder/NormalizationAwareInterface.php';
include_once $this->targetDirs[3].'/vendor/symfony/serializer/Encoder/XmlEncoder.php';
include_once $this->targetDirs[3].'/vendor/symfony/serializer/Encoder/JsonEncoder.php';
include_once $this->targetDirs[3].'/vendor/symfony/serializer/Encoder/YamlEncoder.php';
include_once $this->targetDirs[3].'/vendor/symfony/serializer/Encoder/CsvEncoder.php';

return $this->services['serializer'] = new \Symfony\Component\Serializer\Serializer(array(0 => ($this->privates['App\Normalizer\ArrayCollectionNormalizer'] ?? $this->privates['App\Normalizer\ArrayCollectionNormalizer'] = new \App\Normalizer\ArrayCollectionNormalizer()), 1 => ($this->privates['App\Normalizer\DateTimeNormalizer'] ?? $this->privates['App\Normalizer\DateTimeNormalizer'] = new \App\Normalizer\DateTimeNormalizer()), 2 => ($this->privates['App\Normalizer\EntityNormalizer'] ?? $this->load('getEntityNormalizerService.php')), 3 => ($this->privates['serializer.normalizer.json_serializable'] ?? $this->privates['serializer.normalizer.json_serializable'] = new \Symfony\Component\Serializer\Normalizer\JsonSerializableNormalizer()), 4 => ($this->privates['serializer.normalizer.datetime'] ?? $this->privates['serializer.normalizer.datetime'] = new \Symfony\Component\Serializer\Normalizer\DateTimeNormalizer()), 5 => ($this->privates['serializer.normalizer.constraint_violation_list'] ?? $this->privates['serializer.normalizer.constraint_violation_list'] = new \Symfony\Component\Serializer\Normalizer\ConstraintViolationListNormalizer()), 6 => ($this->privates['serializer.normalizer.dateinterval'] ?? $this->privates['serializer.normalizer.dateinterval'] = new \Symfony\Component\Serializer\Normalizer\DateIntervalNormalizer()), 7 => ($this->privates['serializer.normalizer.data_uri'] ?? $this->privates['serializer.normalizer.data_uri'] = new \Symfony\Component\Serializer\Normalizer\DataUriNormalizer()), 8 => ($this->privates['serializer.denormalizer.array'] ?? $this->privates['serializer.denormalizer.array'] = new \Symfony\Component\Serializer\Normalizer\ArrayDenormalizer()), 9 => ($this->privates['serializer.normalizer.object'] ?? $this->load('getSerializer_Normalizer_ObjectService.php'))), array(0 => ($this->privates['serializer.encoder.xml'] ?? $this->privates['serializer.encoder.xml'] = new \Symfony\Component\Serializer\Encoder\XmlEncoder()), 1 => ($this->privates['serializer.encoder.json'] ?? $this->privates['serializer.encoder.json'] = new \Symfony\Component\Serializer\Encoder\JsonEncoder()), 2 => ($this->privates['serializer.encoder.yaml'] ?? $this->privates['serializer.encoder.yaml'] = new \Symfony\Component\Serializer\Encoder\YamlEncoder()), 3 => ($this->privates['serializer.encoder.csv'] ?? $this->privates['serializer.encoder.csv'] = new \Symfony\Component\Serializer\Encoder\CsvEncoder())));
