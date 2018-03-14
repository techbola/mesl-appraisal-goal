<template>
<table class="table table-hover demo-table-search" id="tableWithSearch">
				<thead>
					<tr>
						<th>Menu Name</th>
						<th>Route</th>
						<th>Description</th>
						<th style="width:30%"></th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(menu, key) in menus" :class="{backgroundAnimated: menu.id == current}">
						<td>{{menu.name}}</td>
						<td>{{menu.route}}</td>
						<td>{{ menu.description }}</td>
						<td class="btn-actions">
						<a class="btn btn-sm" :href="'/menus/'+ menu.id + '/edit'">Edit</a>
							<form method="post" :action="'/menus/'+ menu.id">
							   <input type="hidden" name="_token" v-model="token">
							   <input type="hidden" name="_method" value="DELETE">
							    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
    						</form>
						</td>
						<td>
						</td>
					</tr>
				</tbody>
			</table>
</template>

<script>
export default {
	props:['token'],
  data () {
    return {
		menus: [],
		current: 0
    };
  },
  created() {
  	this.fetchMenus();
  },
  updated() {
  	this.listenForChanges();
  },
  methods: {
  	fetchMenus() {
  		axios.get('/menus').then((response) => {
            this.menus = response.data;
        });
  	},
  	listenForChanges() {
  		Echo.channel('menus')
  		.listen('MenuWasUpdated', (e) => {
			var menu = this.menus.find((menu) => menu.id === e.id);
			var index = this.menus.indexOf(menu);
            this.menus[index].name = e.name;
            this.current = e.id;
  		})
  		.listen('MenuWasCreated', (e) => {
			var menu = this.menus.find((menu) => menu.id === e.id);
			// check if menu was present elese add
			if (!menu) {
				this.menus.push(e);
				this.current = e.id;
			}
			
			
  		})
  		.listen('MenuWasDeleted', (e) => {
			var menu = this.menus.find((menu) => menu.id === e.id);
			var index = this.menus.indexOf(menu);
            this.menus.splice(index,1);

  		});
  	}
  }
};
</script>

<style lang="css" scoped>

@keyframes fadeIt {
  0%   { background-color: #90fcb9; }
  50%  { background-color: #ffffff; }
  100% { background-color: #90fcb9; }
}

.backgroundAnimated th, 
.backgroundAnimated tr, 
.backgroundAnimated td{    
    -webkit-animation: fadeIt .1s ease-in-out; 
       -moz-animation: fadeIt .1s ease-in-out; 
         -o-animation: fadeIt .1s ease-in-out; 
            animation: fadeIt .1s ease-in-out; 
}

.btn-actions > a, 
.btn-actions > form {
display: inline-block;
}
</style>