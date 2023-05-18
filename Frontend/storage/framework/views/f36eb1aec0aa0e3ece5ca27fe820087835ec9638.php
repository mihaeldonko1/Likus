<?php
if(isset($data['data']['attributes']['zivljenjepis']['data']) && $data['data']['attributes']['zivljenjepis']['data']!=null){
    $zivljenjepisId = $data['data']['attributes']['zivljenjepis']['data']['id'];
}else{
    $zivljenjepisId = 0;
}
?>


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

        let zivljenjepisId = <?php echo $zivljenjepisId; ?>;
        console.log(zivljenjepisId);
        if(zivljenjepisId > 0){
            odtConverter(zivljenjepisId);
        } else {
            document.getElementById('outputZivljenjepis').textContent = "Član žal še ni objavil svojega življenjepisa";
        }
</script>



<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\mihad\OneDrive\Namizje\Likus\Likus\Frontend\resources\views/singlemember.blade.php ENDPATH**/ ?>