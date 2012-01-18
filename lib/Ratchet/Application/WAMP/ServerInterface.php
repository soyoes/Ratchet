<?php
namespace Ratchet\Application\WAMP;
use Ratchet\Resource\Connection;

/**
 * A (not literal) extension of Ratchet\Application\ApplicationInterface
 * onMessage is replaced by various types of messages for this protocol (pub/sub or rpc)
 * @todo Thought: URI as class.  Class has short and long version stored (if as prefix)
 */
interface ServerInterface {
    /**
     * When a new connection is opened it will be passed to this method
     * @param Ratchet\Resource\Connection
     */
    function onOpen(Connection $conn);

    /**
     * The user closed their connection
     * @param Ratchet\Resource\Connection
     * @return Ratchet\Resource\Command\CommandInterface|null
     */
    function onClose(Connection $conn);

    /**
     * @param Ratchet\Resource\Connection
     * @param \Exception
     * @return Ratchet\Resource\Command\CommandInterface|null
     */
    function onError(Connection $conn, \Exception $e);

    /**
     * An RPC call has been received
     * @param Ratchet\Resource\Connection
     * @param string
     * @param ...
     * @return Ratchet\Resource\Command\CommandInterface|null
     */
    function onCall();

    /**
     * A request to subscribe to a URI has been made
     * @param Ratchet\Resource\Connection
     * @param ...
     * @return Ratchet\Resource\Command\CommandInterface|null
     */
    function onSubscribe(Connection $conn, $uri);

    /**
     * A request to unsubscribe from a URI has been made
     * @param Ratchet\Resource\Connection
     * @param ...
     * @return Ratchet\Resource\Command\CommandInterface|null
     */
    function onUnSubscribe(Connection $conn, $uri);

    /**
     * A client is attempting to publish content to a subscribed connections on a URI
     * @param Ratchet\Resource\Connection
     * @param ...
     * @param string
     * @return Ratchet\Resource\Command\CommandInterface|null
     */
    function onPublish(Connection $conn, $uri, $event);
}