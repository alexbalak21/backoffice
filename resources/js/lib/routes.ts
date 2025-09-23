export interface RouteDefinition {
  url: string;
  method?: string;
}

export const routes = {
  dashboard: (): RouteDefinition => ({ url: '/dashboard' }),
  settings: {
    profile: (): RouteDefinition => ({ url: '/settings/profile' }),
    password: (): RouteDefinition => ({ url: '/settings/password' }),
    twoFactor: (): RouteDefinition => ({ url: '/settings/two-factor' }),
    appearance: (): RouteDefinition => ({ url: '/settings/appearance' }),
  },
  auth: {
    login: { url: '/login' },
    register: { url: '/register' },
  },
};

// Helper function to get URL from route
export function getRouteUrl(route: RouteDefinition | (() => RouteDefinition)): string {
  const routeObj = typeof route === 'function' ? route() : route;
  return routeObj?.url || '/';
}
