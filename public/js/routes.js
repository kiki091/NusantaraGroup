import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const router = new VueRouter({

	routes: [
		{
			path: "/web",
			component: Web
		},
	]
})

export default router