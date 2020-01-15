window.onload = function(){
	var registro = new Vue({
		el: '#usuario',
		created () {
			//Ejecucion
			this.culo();
		},
		mounted(){
			var self=this
		},
		data:{
			usuario ='',
		},
		methods:{
			//funciones
			culo(){
				alert('mml')
			}
		},
		computed:{

		},

	})
}