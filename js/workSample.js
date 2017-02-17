/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var onoff = document.getElementById('onoff');
var form = document.getElementById('sample');
var msg = document.getElementById('msg');
var error = document.querySelector('.error');
onoff.addEventListener('click', function() {//switch the on off button to show and hide the input form
    if (this.value === 'disable') {
        this.value = 'enable';
        form.style.display = 'none';
        msg.textContent = '';
    } else {
        this.value = 'disable';
        form.elements['decimal'].value = '';
        error.textContent = '';
        error.className = 'error';
        form.style.display = 'block';
    }
}, false);
//check form value through event handler
form.elements['decimal'].addEventListener('blur', checkDecimal, false);
//ajax submit form in jquery    
$('#sample').on('submit', function(e) {
    e.preventDefault();
    if (checkDecimal()) {
        var details = $('#sample').serialize();
        $.post('../php/newEmptyPHP.php', details, function(data) {
            $('#msg').html(data);
        })
    } 
});

function checkDecimal() {
    var deciNumber = form.elements['decimal'].value.trim();
    if (Number(deciNumber) == deciNumber && deciNumber.lastIndexOf('.') !== -1 && deciNumber.substr(-1) !== '.') {//if the number is a decimal  && deciNumber.indexOf('.') !== -1
        error.innerHTML = '';
        error.className = 'error';
        return true;
    } else {
        error.innerHTML = 'the input is not a decimal number please enter it again';
        error.className = 'error active';
        return false;
    }
}

