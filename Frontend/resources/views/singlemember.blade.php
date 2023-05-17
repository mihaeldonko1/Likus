<?php print_r($data); ?>
<div class="container mt-4">
        <h1>Member Details</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">General Information</h5>

                <dl class="row">

                    <dt class="col-sm-3">Ime</dt>
                    <dd class="col-sm-9">{{ $data['data']['attributes']['Ime'] }}</dd>

                    <dt class="col-sm-3">Priimek</dt>
                    <dd class="col-sm-9">{{ $data['data']['attributes']['Priimek'] }}</dd>

                    <dt class="col-sm-3">Spol</dt>
                    <dd class="col-sm-9">{{ $data['data']['attributes']['Spol'] }}</dd>

                    <dt class="col-sm-3">Naslov</dt>
                    <dd class="col-sm-9">{{ $data['data']['attributes']['Naslov'] }}</dd>

                </dl>
            </div>
        </div>
    </div>
