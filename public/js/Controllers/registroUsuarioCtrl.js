window.onload = function(){
	var registro = new Vue({
		el: '#usuario',
		created () {
			//Ejecucion
			this.prueba();
		},
		mounted(){
			var self=this
		},
		data:{
			usuario ='',
		},
		methods:{
			//funciones
			prueba(){
				alert('mml')
			}
		},
		computed:{

		},

	})
}