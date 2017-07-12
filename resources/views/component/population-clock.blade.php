<?php

$censusInformation = app('Pmis\Eloquent\CensusInformation');

$currentCensusInformation = $censusInformation->active()->first();

?>
@if(!is_null($currentCensusInformation))
    <script type="text/javascript">
        $(document).ready(function(){
            var pop_start = {{ $currentCensusInformation->total_population}} ,
                births_sec = {{ $currentCensusInformation->birth_per_sec}},
                deaths_sec = {{ $currentCensusInformation->death_per_sec}},
                migration_sec = {{ $currentCensusInformation->migration_per_sec}},
                census_year = {{ $currentCensusInformation->census_year->format('Y')}},
                census_month = {{ $currentCensusInformation->census_year->format('m')}},
                census_day = {{ $currentCensusInformation->census_year->format('d')}},
                sex_ratio = {{ $currentCensusInformation->sex_ratio}};

            var show = function () {
                extract(pop_start,births_sec,deaths_sec, migration_sec, sex_ratio,census_year,census_month,census_day)
                //, 1416.4129883308, 12636686400, 21.865953830543
                setTimeout(function () {
                    show();
                }, 333); // Adjust the timeout value as you like
            }
            show();
        });
    </script>
@endif