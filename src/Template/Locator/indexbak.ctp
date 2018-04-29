<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dealer[]|\Cake\Collection\CollectionInterface $dealers
 */
?>
<div class="container">
    <div class="row">
        <div class="col-xs-4">
	<?= $this->Form->create('Locator', array('url' => array('action' => 'index'), 'enctype' => 'multipart/form-data'));
        echo $this->Form->input('address', array('label'=>'Zip Code','type' => 'text','id' => 'geocomplete'));
echo $this->Form->hidden('lat');
$this->Form->unlockField('lat');
echo $this->Form->hidden('lng');
$this->Form->unlockField('lng');
echo $this->Form->button('Search', ['class' => 'btn btn-lg btn-success1 btn-block padding-t-b-15']);
echo $this->Form->end();
?>
<?php 
if (isset($query)) {
foreach ($query as $dealer): ?>
<div class="card" >
	<div class="card-block">
                <h6 class="card-title"><?= h($dealer->name) ?></h4>
                <P class="card-text"><?= h($dealer->address) ?>
                <P class="card-text"><?= h($dealer->address1) ?>
                <p class="card-text"><?= h($dealer->address2) ?>
                <p class="card-text"><?= h($dealer->city) ?>
                <p class="card-text"><?= h($dealer->state) ?>
                <p class="card-text"><?= h($dealer->zip) ?>
                <p class="card-text"><?= h($dealer->country) ?>
                <p class="card-text"><?= h($dealer->telephone) ?>
                <p class="card-text"><?= h($dealer->fax) ?>
		<P class="card-text"><?= h($dealer->distance) ?> miles away
            </div>
</div>
            <?php endforeach;
	}	 ?>

	</div>
        <div class="col-xs-8" style="width: 50%">
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
</div>

