<?php

namespace Hslavich\OneloginSamlBundle\Saml2;

use OneLogin\Saml2\Auth as OneLoginAuth;
use OneLogin\Saml2\Response;
use Psr\Log\LoggerInterface;

/**
 * This class is used to log responses from SAML IdP.
 */
class Auth extends OneLoginAuth
{
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function processResponse($requestId = null)
    {
        if ($_SERVER['LOG_SAML_RESPONSE'] === 'true') {
            if (isset($_POST['SAMLResponse'])) {
                $response = new Response($this->getSettings(), $_POST['SAMLResponse']);
                $this->logger->info($response->response);
            }
        }

        parent::processResponse($requestId = null);
    }
}
