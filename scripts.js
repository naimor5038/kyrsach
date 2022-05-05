function register() {
    let log =$('#login').val()
    let pas = $('#password').val()
    let email = $('#email').val()
    let name = $('#name').val()
    $.post('registr.php', {login:log, password:pas, email:email, name:name}, function(data){

        let otvet = JSON.parse(data)
        if ('error' in otvet) {
            alert(otvet['error']['text'])
        }
        else if ('response' in otvet) {
            console.log(otvet)
            alert(otvet['response']['text'])
			window.open('avtoreg.html', '_blank');
        }
        else {
            alert('Непредвиденная ошибка')
            console.log(data)
        }
    });
}

