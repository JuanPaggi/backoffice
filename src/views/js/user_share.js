$(document).ready(function(){
    // sort alphabetically:
    let elements = $('#targets').find('option');
    console.log('finded:', elements);
    elements.sort((elemA, elemB) => {
        // negativo cero positivo
        return elemA.text() < str2.text() ? -1 : str1.text() > str2.text();
    });
    $('#targets').html('');
    console.log('sorted:', elements);
    elements.forEach((elem) => {
        $('#targets').append('<option value="'+elem.val()+'">'+elem.text()+'</option>');
    });
});