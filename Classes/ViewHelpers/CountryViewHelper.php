<?php
namespace NeosRulez\Form\CountrySelect\ViewHelpers;

use Neos\Flow\Annotations as Flow;
use Symfony\Component\Yaml\Yaml;

class CountryViewHelper extends \Neos\FluidAdaptor\Core\ViewHelper\AbstractViewHelper {


    public function initializeArguments()
    {
        $this->registerArgument('countries', 'array', 'Array with the selected countries', true);
    }

    /**
     * @return array
     */
    public function render() {
        $selectedCountries = $this->arguments['countries'];
        $countries = $this->loadMetaData();
        $result = [];
        if($countries) {
            foreach ($countries as $i => $country) {
                foreach ($selectedCountries as $selectedCountry) {
                    if($country['cca2'] == $selectedCountry) {
                        $result[$i]['cca2'] = $country['cca2'];
                        $result[$i]['name']['common'] = $country['name']['common'];
                    }
                }
            }
        }
        return $result;
    }

    /**
     * @return array
     */
    function loadMetaData():array
    {
        $fileName = sprintf('resource://NeosRulez.CountryDataSource/Private/Metadata/countries.yml');
        return (array) Yaml::parseFile($fileName);
    }

}
