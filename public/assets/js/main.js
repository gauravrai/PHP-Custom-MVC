const app = new Vue({
        el : '#app',
        data() {
            return {
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
            if(document.querySelector('input[id=userId]')){
                this.input.id = document.querySelector('input[id=userId]').value
                this.profile()
            }
        },
        methods: {
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