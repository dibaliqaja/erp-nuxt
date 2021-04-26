export default async ({ store, redirect, route }) => {
    const user = store.getters['auth/user']
    for (let index = 0; index < route.meta.length; index++) {
        if (route.meta[index].permission) {
            if (!store.getters['auth/check']) {
                window.previousPath = route.fullPath
                return redirect('/login')
            }
            if (!user.all_permissions || user.all_permissions.indexOf(route.meta[index].permission) ==  -1) {
                return redirect('/unauthorized')
            }
        }
        
    }
}