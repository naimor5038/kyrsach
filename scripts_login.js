 function login() {
        let log = $('#login').val()
        let pas = $('#password').val()

        $.post('login.php', {login:log, password:pas}, function(data){
            let otvet = JSON.parse(data)
            if ('error' in otvet) {
                alert(otvet['error']['text'])
            }
            else if ('response' in otvet) {
				alert('Вы успешно авторизовались')
				user = otvet['response'][0]
				localStorage['login'] = user['login']
				localStorage['token'] = user['token']
				localStorage['expire'] = user['expiration']
				window.location.href = 'glavnai.html'
            }
            else {
                alert('Непредвиденная ошибка')
                console.log(data)
            }
    });
}