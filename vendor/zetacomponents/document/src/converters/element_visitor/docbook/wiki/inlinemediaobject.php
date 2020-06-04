<?php
/**
 * File containing the ezcDocumentDocbookToWikiInlineMediaObjectHandler class.
 *
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 * 
 *   http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 *
 * @package Document
 * @version //autogen//
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */

/**
 * Visit inline media objects
 *
 * Inline media objects are all kind of other media types, embedded in
 * paragraphs, like images.
 *
 * @package Document
 * @version //autogen//
 */
class ezcDocumentDocbookToWikiInlineMediaObjectHandler extends ezcDocumentDocbookToWikiMediaObjectHandler
{
    /**
     * Handle a node.
     *
     * Handle / transform a given node, and return the result of the
     * conversion.
     *
     * @param ezcDocumentElementVisitorConverter $converter
     * @param DOMElement $node
     * @param mixed $root
     * @return mixed
     */
    public function handle( ezcDocumentElementVisitorConverter $converter, DOMElement $node, $root )
    {
        $image = $this->getImageParameters( $converter, $node );

        if ( isset( $image['alt'] ) || isset( $image['text'] ) )
        {
            $root .= sprintf( '{{%s|%s}}',
                $image['resource'],
                isset( $image['text'] ) ? $image['text'] : $image['alt']
            );
        }
        else
        {
            $root .= sprintf( '{{%s}}', $image['resource'] );
        }

        return $root;
    }
}

?>
