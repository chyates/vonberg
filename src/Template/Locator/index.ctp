<div id="find-distributor-main" class="inner-main col-lg-10 col-12 mx-auto p-sm-5 p-3">
    <div class="row">
        <div class="col-lg-5 col-sm-10 mx-sm-auto left-search">
            <h1 class="page-header">Find a Distributor</h1>
            <p class="product-info">Enter Zip Code or Leave Empty to Use Current Location</p>
            <?= $this->Form->create('Locator', array('url' => array('action' => 'index'),'class' => 'form-inline', 'enctype' => 'multipart/form-data'));
            echo $this->Form->input('address', array('placeholder'=>"Enter Zip Code",'class' => 'form-control','label'=>'','type' => 'text','id' => 'geocomplete'));
            echo $this->Form->hidden('lat', array('id' => 'lat'));
            $this->Form->unlockField('lat');
            echo $this->Form->hidden('lng', array('id' => 'lng'));
            $this->Form->unlockField('lng');
            echo $this->Form->submit('Find', array('class' => 'btn btn-default'));
            echo $this->Form->end();
            ?>
                <!-- Default to this block of text if nothing has been searched -->
                <!-- <p class="mx-auto my-auto search-text-default">Use the search bar above to find distributors in your area.</p> -->

                <!-- Else, populate search results like this: -->
            <?php
                if (!empty($query)) {
            echo '<p class="miles-text">Results within 200 miles</p>
            <div class="search-block mt-2 p-4">';
            foreach ($query as $dealer): ?>

                <h4><?= h($dealer->name) ?></h4>
                <div class="row no-gutters">
                    <div class="col-8 d-flex flex-column justify-content-between">
                        <p><?= h($dealer->address) ?><BR><?= h($dealer->address1) ?><BR><?= h($dealer->address2) ?><br><?= h($dealer->city) ?>, <?= h($dealer->state) ?> <?= h($dealer->zip) ?></p>
                        <p><a class="results-link" href="/test">URL HERE</a></p>
                    </div>
                    <div class="col-4 d-flex flex-column justify-content-between">
                        <p>P: <?= h($dealer->telephone) ?> <br> F: <?= h($dealer->fax) ?></p>
                        <p><a class="results-link" href="/test">Get directions ></a></p>
                        <P><?= h($dealer->distance) ?> miles away
                    </div>
                </div>
                <?php endforeach;
                echo '            </div>';
                } ?>
        </div><!-- .left-search end -->

        <div class="col-lg-7 col-10 mx-sm-auto my-lg-0 my-sm-3 right-map">
            <?php
            $options = [
                'zoom' => 6,
                'type' => 'R',
                'lat'=> $lat,
                'lng'=> $lng,
                'unitSystem'=> 'UnitSystem.IMPERIAL',
                'geolocate' => true,
                'div' => ['id' => 'someothers'],
                'map' => ['navOptions' => ['style' => 'SMALL']]
            ];
            $map =  $this->GoogleMap->map($options);

            // You can echo it now anywhere, it does not matter if you add markers afterwards
            echo $map;

            // Let's add some markers
            if (isset($query)) {
                foreach ($query as $dealer):
                    $this->GoogleMap->addMarker(['lat' => $dealer->lat, 'lng' => $dealer->lng, 'title' => $dealer->name, 'content' => $dealer->address, 'icon' => $this->GoogleMap->iconSet('green', $dealer->id )]);

                endforeach;
            }
            $this->GoogleMap->finalize()
            ?>
        </div>
    </div>
</div><!-- #find-distributor-main end -->
