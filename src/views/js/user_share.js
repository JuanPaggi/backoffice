$(document).ready(function(){
    // sort alphabetically:
    let elements = $('#targets').find('options');
    elements.sort((elemA, elemB) => {
        // negativo cero positivo
        return elemA.text() < str2.text() ? -1 : str1.text() > str2.text();
    });
    $('#targets').html('');
    elements.foreach((elem) => {
        $('#targets').append('<option value="'+elem.val()+'">'+elem.text()+'</option>');
    });
});