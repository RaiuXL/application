<?php

/**
 * Get experience levels.
 *
 * @return array
 */
function getExperience()
{
    return array('0-2', '2-4', '4+');
}

/**
 * Get relocation options.
 *
 * @return array
 */
function getRelocationOptions()
{
    return array('Yes', 'No', 'Maybe');
}

/**
 * Get job openings.
 *
 * @return array
 */
function getJobOpenings()
{
    return array('JavaScript', 'HTML', 'PHP', 'CSS', 'Java', 'ReactJS', 'Python', 'NodeJS');
}

/**
 * Get industry verticals.
 *
 * @return array
 */
function getIndustryVerticals()
{
    return array('SaaS', 'Industrial Tech', 'Health Tech', 'Cybersecurity', 'Ag Tech', 'HR Tech');
}

/**
 * Get states.
 *
 * @return array
 */
function getStates()
{
    return array(
        'WA' => 'Washington',
        'AL' => 'Alabama',
        'AK' => 'Alaska',
        'AZ' => 'Arizona',
        'AR' => 'Arkansas',
        'CA' => 'California',
        'CO' => 'Colorado',
        'CT' => 'Connecticut',
        'DE' => 'Delaware',
        'DC' => 'District Of Columbia',
        'FL' => 'Florida',
        'GA' => 'Georgia',
        'HI' => 'Hawaii',
        'ID' => 'Idaho',
        'IL' => 'Illinois',
        'IN' => 'Indiana',
        'IA' => 'Iowa',
        'KS' => 'Kansas',
        'KY' => 'Kentucky',
        'LA' => 'Louisiana',
        'ME' => 'Maine',
        'MD' => 'Maryland',
        'MA' => 'Massachusetts',
        'MI' => 'Michigan',
        'MN' => 'Minnesota',
        'MS' => 'Mississippi',
        'MO' => 'Missouri',
        'MT' => 'Montana',
        'NE' => 'Nebraska',
        'NV' => 'Nevada',
        'NH' => 'New Hampshire',
        'NJ' => 'New Jersey',
        'NM' => 'New Mexico',
        'NY' => 'New York',
        'NC' => 'North Carolina',
        'ND' => 'North Dakota',
        'OH' => 'Ohio',
        'OK' => 'Oklahoma',
        'OR' => 'Oregon',
        'PA' => 'Pennsylvania',
        'RI' => 'Rhode Island',
        'SC' => 'South Carolina',
        'SD' => 'South Dakota',
        'TN' => 'Tennessee',
        'TX' => 'Texas',
        'UT' => 'Utah',
        'VT' => 'Vermont',
        'VA' => 'Virginia',
        'WV' => 'West Virginia',
        'WI' => 'Wisconsin',
        'WY' => 'Wyoming'
    );
}
