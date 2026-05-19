/**
 * Configuration for Stable Show Page
 * Contains all routes and settings
 */

export const Config = {
    stableId: window.stableId || 0,
    routes: {
        atlet: {
            store: `/stable/${window.stableId}/atlet`,
            update: `/stable/${window.stableId}/atlet/:id`,
            destroy: `/stable/${window.stableId}/atlet/:id`
        },
        kuda: {
            store: `/stable/${window.stableId}/kuda`,
            update: `/stable/${window.stableId}/kuda/:id`,
            destroy: `/stable/${window.stableId}/kuda/:id`
        },
        pelatih: {
            users: `/stable/${window.stableId}/pelatih/users`,
            store: `/stable/${window.stableId}/pelatih`,
            update: `/stable/${window.stableId}/pelatih/:id`,
            destroy: `/stable/${window.stableId}/pelatih/:id`
        }
    }
};
