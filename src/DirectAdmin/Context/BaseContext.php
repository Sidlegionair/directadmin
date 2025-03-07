<?php

/*
 * DirectAdmin API Client
 * (c) Omines Internetbureau B.V. - https://omines.nl/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Omines\DirectAdmin\Context;

use Omines\DirectAdmin\DirectAdmin;

/**
 * Encapsulates a contextual connection to a DirectAdmin server.
 *
 * @author Niels Keurentjes <niels.keurentjes@omines.com>
 */
abstract class BaseContext
{
    /** @var DirectAdmin */
    private $connection;

    /**
     * Constructs the object.
     *
     * @param DirectAdmin $connection A prepared connection
     */
    public function __construct(DirectAdmin $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Returns the internal connection wrapper.
     *
     * @return DirectAdmin
     */
    protected function getConnection()
    {
        return $this->connection;
    }

    /**
     * Invokes the DirectAdmin API via HTTP GET.
     *
     * @param string $command DirectAdmin API command to invoke
     * @param array $query Optional query parameters
     * @return array The parsed and validated response
     */
    public function invokeApiGet($command, $query = [], $allow_html_response = false)
    {
        return $this->connection->invokeApi('GET', $command, ['query' => $query], $allow_html_response);
    }

    /**
     * Invokes the DirectAdmin API via HTTP POST.
     *
     * @param string $command DirectAdmin API command to invoke
     * @param array $postParameters Optional form parameters
     * @param boolean $allow_html_response Optional parameter to allow returning a response containing html instead of json
     * @return array The parsed and validated response
     */
    public function invokeApiPost($command, $postParameters = [], $allow_html_response = false)
    {
        return $this->connection->invokeApi('POST', $command, ['form_params' => $postParameters], $allow_html_response);
    }

    /**
     * @param $method
     * @param $uri
     * @param $options
     */
    public function rawRequest($method, $uri, $options, $allow_html_response = false, $form_params = true)
    {
        if($form_params == true) {
            return $this->connection->rawRequest($method, $uri, ['form_params' => $options], $allow_html_response);
        }
        if($form_params == false) {
            return $this->connection->rawRequest($method, $uri, $options, $allow_html_response);
        }
    }
}
