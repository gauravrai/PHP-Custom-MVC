const vueApp = new Vue({
        el : '#app',
        data() {
            return {
                errors: [],
                input: {
                    email: "",
                    password: "",
                    username: "",
                    contact: "",
                    id: 0
                },
                html: {
                    message: "",
                    showMessage: false
                }
            }
        },
        created: function (){
            //just to ensure this code must work with profile page only
            if(document.querySelector('input[id=userId]')){
                this.input.id = document.querySelector('input[id=userId]').value
                this.profile()
            }
        },
        methods: {
            validEmail: function (email) {
              var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
              return re.test(email);
            },
            checkForm(e){
                this.errors = []
                if(!this.input.username)
                    this.errors.push('Username required')
                if(!this.input.email)
                    this.errors.push('Email required')
                else if(!this.validEmail(this.input.email))
                    this.errors.push('Enter valid email')
                    
                
                if(this.errors.length)
                    return false
                return true
            },
            async profile(){
                
                if(this.input.id>0){
                    await axios.get('/api/profile/' + this.input.id).then((response) => {
                        this.input.username = response.data.data.username
                        this.input.email = response.data.data.email
                        this.input.password = response.data.data.password
                        this.input.contact = response.data.data.contact                        
                    }).catch((e) => {
                        console.log(e)
                    })
                }
            },
            async register(){
                if(this.checkForm()){
                    this.html.message = ''
                    this.html.showMessage = false
                    await axios.post('/api/register', {
                        email: this.input.email,
                        password: this.input.password,
                        username: this.input.username,
                        contact: this.input.contact
                    }).then((response) => {
                        this.html.message = response.data.message
                        this.html.showMessage = true
                        if(response.data.data.error==0){
                            window.location = '/home/';
                        }
                        
                    }).catch((e) => {
                        console.log(e)
                    })
                }
            },
            async login(){
                this.html.message = ''
                this.html.showMessage = false
                await axios.post('/api/login', {
                    username: this.input.username,
                    password: this.input.password
                }).then((response) => {
                    this.html.message = response.data.message
                    this.html.showMessage = true
                    if(response.data.data.error==0){
                        window.location = '/home/';
                    }
                }).catch((e) => {
                    console.log(e)
                })
                
            }
        }
    });