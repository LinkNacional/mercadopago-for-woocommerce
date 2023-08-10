<?php

namespace MercadoPago\PP\Sdk\Interfaces;
use Exception;

interface RequesterEntityInterface {
    /**
     * Get and set custom headers for entity.
     *
     * @return array
     */
    public function getHeaders(): array;

    /**
     * Get uris.
     *
     * @return array
     */
    public function getUris(): array;

    /**
     * Read method (GET).
     *
     * @param array $params
     *
     * @return mixed
     * @throws Exception
     */
    public function read(array $params = array());

    /**
     * Save method (POST).
     *
     * @return mixed
     * @throws Exception
     */
    public function save();
}
