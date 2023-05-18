<?php
    if(isset($data['data']['attributes']['zivljenjepis']['data']) && $data['data']['attributes']['zivljenjepis']['data']!=null){
        $zivljenjepisId = $data['data']['attributes']['zivljenjepis']['data']['id'];
    }else{
        $zivljenjepisId = 0;
    }
    if(isset($data['data']['attributes']['rokopis']['data']) && $data['data']['attributes']['rokopis']['data']!=null){
        $rokopisId = $data['data']['attributes']['rokopis']['data']['id'];
    }else{
        $rokopisId = 0;
    }
?>
<style>
    .rokopisIMG{
        width: 50%;
    }
</style>


<div class="container mt-4">
    <div class="row">
        <h5>Informacije o članu</h5>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <?php if(isset($data['data']['attributes']['Profilna_slika']['data'][0]['attributes']['url'])): ?>
                        <img src="http://localhost:1337<?php echo e($data['data']['attributes']['Profilna_slika']['data'][0]['attributes']['url']); ?>" >
                <?php else: ?>
                        <img src="https://icon-library.com/images/no-profile-pic-icon/no-profile-pic-icon-7.jpg" style="transform: scale(0.5);">
                <?php endif; ?>
            </div>
            <div class="row">
               <span><?php echo e($data['data']['attributes']['Ime']); ?> <?php echo e($data['data']['attributes']['Priimek']); ?></span><br />
               <span>Spol: <?php echo e($data['data']['attributes']['Spol']); ?></span>
               <span>Datum rojstva: <?php echo e(date('d-m-Y', strtotime($data['data']['attributes']['Rojstni_dan']))); ?></span>
            </div>
        </div>
        <div class="col-md-8">
            <h5>Življenjepis <?php echo e($data['data']['attributes']['Ime']); ?> <?php echo e($data['data']['attributes']['Priimek']); ?></h5>
            <div id="outputZivljenjepis"></div>
        </div>
    </div>  
    <hr> 
    <div class="row">
        <div class="col-md-12">
            <h3>Rokopis</h3>
            <div id="rokopisContainer"></div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <h3>Članki</h3>
        </div>
        <?php $__currentLoopData = $data['data']['attributes']['clanki']['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Identifikacijska št. članka:<?php echo e($val['id']); ?></h5>
                    <p class="card-text">Letnica knjige: <?php echo e($val['attributes']['Letnica_zbornika']); ?></p>
                    <p class="card-text">Številka knjige: <?php echo e($val['attributes']['Stevilka_knjige']); ?></p>
                    <p class="card-text">Strani v knjigi: <?php echo e($val['attributes']['Strani_od_do']); ?></p>
                    <button data-book="<?php echo e($val['id']); ?>" class="btn btn-primary">Preberi članek</button>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<script>
function odtConverter(odtpath) {
    let urltoODT = '';
    fetch(`http://localhost:1337/api/zivljenjepisi/${odtpath}?populate=*`)
        .then(response => response.json())
        .then(data => {
            urltoODT = "http://localhost:1337" + data.data.attributes.Zivljenjepis.data[0].attributes.url;
            return fetch(urltoODT); 
        })
        .then(response => response.blob())
        .then(blob => {
            const reader = new FileReader();

            reader.onload = function (event) {
                const content = event.target.result;
                const zip = new JSZip();

                zip.loadAsync(content).then(function (zip) {
                    const xmlFile = zip.file("content.xml");

                    if (xmlFile) {
                        xmlFile.async("string").then(function (xmlContent) {
                            const parser = new DOMParser();
                            const xmlDoc = parser.parseFromString(xmlContent, "text/xml");
                            const paragraphs = xmlDoc.getElementsByTagName("text:p");
                            let formattedText = "";

                            for (let i = 0; i < paragraphs.length; i++) {
                                const paragraphText = paragraphs[i].textContent;
                                const trimmedText = paragraphText.trim();

                                if (trimmedText.length > 0) {
                                    const lines = trimmedText.split("\n");
                                    const formattedLines = lines.map(line => "<p>" + line + "</p>").join("\n");
                                    formattedText += formattedLines + "\n\n";
                                }
                            }

                            document.getElementById('outputZivljenjepis').innerHTML = formattedText;
                        });
                    } else {
                        document.getElementById('outputZivljenjepis').textContent = "Invalid .odt file.";
                    }
                });
            };

            reader.readAsArrayBuffer(blob);
        })
        .catch(error => {
            document.getElementById('outputZivljenjepis').textContent = "Error loading the .odt file.";
            console.error(error);
        });
    }
        function getRokopis(rokopisID) {
            fetch(`http://localhost:1337/api/rokopisi/${rokopisID}?populate=*`)
                .then(response => response.json())
                .then(data => {
                    let allRokopis = data.data.attributes.Rokopis_datoteke.data[0].attributes.url;
                    let fullRokopisURL = "http://localhost:1337" + allRokopis;

                    let rokopisImg = document.createElement('img');
                    rokopisImg.setAttribute('src', fullRokopisURL);
                    rokopisImg.classList.add('rokopisIMG');

                    let rokopisContainer = document.getElementById('rokopisContainer');
                    rokopisContainer.appendChild(rokopisImg);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        let zivljenjepisId = <?php echo $zivljenjepisId; ?>;
        if(zivljenjepisId > 0){
            odtConverter(zivljenjepisId);
        } else {
            document.getElementById('outputZivljenjepis').textContent = "Član žal še ni objavil svojega življenjepisa";
        }

        let rokopisId = <?php echo $rokopisId; ?>;
        console.log(rokopisId);
        if(rokopisId > 0){
            getRokopis(rokopisId);
        } else {
            console.log("ni rokopisa");
        }

</script>



<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\mihad\OneDrive\Namizje\Likus\Likus\Frontend\resources\views/singlemember.blade.php ENDPATH**/ ?>