function odtConverter(odtFilePath) {
    fetch(odtFilePath)
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