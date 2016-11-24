<?php
namespace SportTools;

use SimpleXMLElement;
use SportTools\Track\TrackPoint;
use SportTools\Track\TrackPointCollection;

/**
 * Class GPXGenerator
 * @package SportTools
 */
class GPXGenerator
{
    const CREATOR = 'plugowski/SportTools';
    const GPX_VERSION = '1.1';
    const XML_XMLNS = 'http://www.topografix.com/GPX/1/1';
    const XML_XMLNS_GPXTPX = 'http://www.garmin.com/xmlschemas/TrackPointExtension/v1';
    const XML_XMLNS_GPXX = 'http://www.garmin.com/xmlschemas/GpxExtensions/v3';
    const XML_XMLNS_XSI = 'http://www.w3.org/2001/XMLSchema-instance';
    const XML_XSI_SCHEMA_LOCATION = [
        'http://www.topografix.com/GPX/1/1',
        'http://www.topografix.com/GPX/1/1/gpx.xsd',
        'http://www.garmin.com/xmlschemas/GpxExtensions/v3',
        'http://www.garmin.com/xmlschemas/GpxExtensionsv3.xsd',
        'http://www.garmin.com/xmlschemas/TrackPointExtension/v1',
        'http://www.garmin.com/xmlschemas/TrackPointExtensionv1.xsd'
    ];

    /**
     * @var TrackPointCollection
     */
    private $trackCollection;

    /**
     * GPXGenerator constructor.
     * @param TrackPointCollection $trackCollection
     */
    public function __construct(TrackPointCollection $trackCollection)
    {
        $this->trackCollection = $trackCollection;
    }

    /**
     * @param SimpleXMLElement $xml
     */
    private function attachDeclaration(SimpleXMLElement $xml)
    {
        $xml->addAttribute('version', self::GPX_VERSION);
        $xml->addAttribute('xsi:schemaLocation', implode(' ', self::XML_XSI_SCHEMA_LOCATION), self::XML_XMLNS_XSI);
        $xml->addAttribute('xmlns:gpxtpx', self::XML_XMLNS_GPXTPX, self::XML_XMLNS);
        $xml->addAttribute('xmlns:gpxx', self::XML_XMLNS_GPXX, self::XML_XMLNS);;
    }

    public function generate()
    {
        $test = <<<GPX
        <?xml version="1.0" encoding="UTF-8"?>
        <gpx version="1.1" 
            creator="Endomondo.com" 
            xsi:schemaLocation="http://www.topografix.com/GPX/1/1 http://www.topografix.com/GPX/1/1/gpx.xsd http://www.garmin.com/xmlschemas/GpxExtensions/v3 http://www.garmin.com/xmlschemas/GpxExtensionsv3.xsd http://www.garmin.com/xmlschemas/TrackPointExtension/v1 http://www.garmin.com/xmlschemas/TrackPointExtensionv1.xsd" 
            xmlns="http://www.topografix.com/GPX/1/1" 
            xmlns:gpxtpx="http://www.garmin.com/xmlschemas/TrackPointExtension/v1" 
            xmlns:gpxx="http://www.garmin.com/xmlschemas/GpxExtensions/v3" 
            xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
            <metadata>
                <author>
                    <name>Pål Ługowski</name>
                    <email id="pawelugowski" domain="gmail.com"/>
                </author>
                <link href="http://www.endomondo.com">
                    <text>Endomondo</text>
                </link>
                <time>2016-11-22T23:58:07Z</time>
            </metadata>
            <trk>
                <type>RUNNING</type>
                <trkseg>
                    <trkpt lat="51.11897" lon="17.0934">
                        <time>2016-11-11T10:03:09Z</time>
                    </trkpt>
                </trkseg>
            </trk>
        </gpx>
GPX;
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><gpx/>');
        $this->attachDeclaration($xml);

        $trk = $xml->addChild('trk');
        $trkseg = $trk->addChild('trkseg');

        /** @var TrackPoint $trackPoint */
        foreach ($this->trackCollection as $trackPoint) {
            $trkpt = $trkseg->addChild('trkpt');
            $trkpt->addAttribute('lat', $trackPoint->getLatitude());
            $trkpt->addAttribute('lon', $trackPoint->getLongitude());
        }
    }
}