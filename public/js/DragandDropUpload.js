/* 
 * @author Thyago Henrique Pacher - thyago.pacher@gmail.com
 */


var holder = document.getElementById('holder');
var holder2 = document.getElementById('holder2');

/**array para definição de testes de compatibilidade*/
var tests = {
    filereader: typeof FileReader != 'undefined',
    dnd: 'draggable' in document.createElement('span'),
    formdata: !!window.FormData,
    progress: "upload" in new XMLHttpRequest
};

/**tipos de documentos aceitos*/
var acceptedTypes = {
    'image/png': true,
    'image/jpeg': true,
    'image/gif': true,
    'image/bmp': true
};

/**array para suporte drag 1*/
var support = {
    filereader: document.getElementById('filereader'),
    formdata: document.getElementById('formdata'),
    progress: document.getElementById('progress')
};

/**array para suporte drag 2*/
var support2 = {
    filereader: document.getElementById('filereader2'),
    formdata: document.getElementById('formdata2'),
    progress: document.getElementById('progress2')
};

/**itens para upload drag1*/
var progress = document.getElementById('uploadprogress');
var fileupload = document.getElementById('upload');

/**itens para upload drag2*/
var progress2 = document.getElementById('uploadprogress2');
var fileupload2 = document.getElementById('upload2');

"filereader formdata progress".split(' ').forEach(function (api) {
    if (tests[api] === false) {
        support[api].className = 'fail';
        support2[api].className = 'fail';
    } else {
        // FFS. I could have done el.hidden = true, but IE doesn't support
        // hidden, so I tried to create a polyfill that would extend the
        // Element.prototype, but then IE10 doesn't even give me access
        // to the Element object. Brilliant.
        support[api].className = 'hidden';
        support2[api].className = 'hidden';
    }
});

function previewfile(file, posicao) {
    if (tests.filereader === true && acceptedTypes[file.type] === true) {
        var reader = new FileReader();
        reader.onload = function (event) {
            if (posicao == '') {
                $("#painel_capa_background").css("background", 'url(' + event.target.result + ')');
            } else {
                $("#painel_foto_background").css("background", 'url(' + event.target.result + ')');
            }
        };

        reader.readAsDataURL(file);
    } else {
        holder.innerHTML += '<p>Uploaded ' + file.name + ' ' + (file.size ? (file.size / 1024 | 0) + 'K' : '');
    }
}

function readfiles(files, posicao) {
    var formData = tests.formdata ? new FormData() : null;
    for (var i = 0; i < files.length; i++) {
        if (tests.formdata) {
            if (posicao == '') {
                formData.append('capa', files[i]);
            } else {
                formData.append('imagem', files[i]);
            }
            formData.append('_token', $("#_token").val());
        }
        previewfile(files[i], posicao);
    }

    // now post a new XHR request
    if (tests.formdata) {
        var xhr = new XMLHttpRequest();
        if (posicao == '') {
            xhr.open('POST', '/upload_capa');
        } else {
            xhr.open('POST', '/upload_foto');
        }
        xhr.onload = function () {
            if (posicao == '') {
                progress.value = progress.innerHTML = 100;
            } else {
                progress2.value = progress2.innerHTML = 100;
            }
        };
        if (tests.progress) {
            xhr.upload.onprogress = function (event) {
                if (event.lengthComputable) {
                    var complete = (event.loaded / event.total * 100 | 0);
                    if (posicao == '') {
                        progress.value = progress.innerHTML = complete;
                    } else {
                        progress2.value = progress2.innerHTML = complete;
                    }
                }
            }
        }
        xhr.send(formData);
    }
}

function pegaImagem(e){
    this.className = '';
    e.preventDefault();
    readfiles(e.dataTransfer.files, '2');
}

$(function () {

    /**testando 1*/
    holder.ondragover = function () {
        this.className = '';
        return false;
    };
    holder.ondragend = function () {
        this.className = '';
        return false;
    };
    holder.ondrop = function (e) {
        this.className = '';
        e.preventDefault();
        readfiles(e.dataTransfer.files, '');
    };

});



