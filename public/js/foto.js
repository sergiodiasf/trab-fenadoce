var imagem = document.getElementById("imagem");
var outFoto = document.getElementById("outFoto");

function previewFile() {
  var foto = imagem.files[0];
  var reader = new FileReader();

  if (!foto.type.startsWith('image/')) {
    outFoto.src = "";
    return;
  }

  outFoto.style.display = 'inline';

  reader.addEventListener("load", function() {
    outFoto.src = reader.result;
  });

  reader.readAsDataURL(foto);
}

imagem.addEventListener("change", previewFile);