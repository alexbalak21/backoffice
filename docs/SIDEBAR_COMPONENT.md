# Sidebar Component Documentation

## Overview
The `sidebar.tsx` component is a responsive, collapsible navigation sidebar that integrates with your application's layout. It's built with React and TypeScript, and uses a context-based state management system for handling its expanded/collapsed states.

## Features

- **Responsive Design**: Automatically adapts between mobile and desktop views
- **Keyboard Navigation**: Supports keyboard shortcuts (Ctrl/Cmd + \)
- **State Management**: Uses React Context for state sharing
- **Customizable**: Easily style using the provided data attributes

## Component Structure

### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `children` | `React.ReactNode` | - | The content to be rendered inside the sidebar |
| `defaultOpen` | `boolean` | `true` | Whether the sidebar is open by default on desktop |
| `defaultOpenMobile` | `boolean` | `false` | Whether the sidebar is open by default on mobile |

### Context Values

The sidebar provides the following values through its context:

```typescript
interface SidebarContext {
  state: 'expanded' | 'collapsed';
  open: boolean;
  setOpen: (open: boolean) => void;
  isMobile: boolean;
  openMobile: boolean;
  setOpenMobile: (open: boolean) => void;
  toggleSidebar: () => void;
}
```

## Usage

### Basic Implementation

```tsx
import { Sidebar } from '@/components/ui/sidebar';

function AppLayout() {
  return (
    <Sidebar>
      {/* Your sidebar content */}
      <div className="p-4">
        <h2>Navigation</h2>
        {/* Navigation items */}
      </div>
    </Sidebar>
  );
}
```

### Using the Sidebar Context

To access the sidebar state and methods in child components:

```tsx
import { useSidebar } from '@/components/ui/sidebar';

function MyComponent() {
  const { state, toggleSidebar } = useSidebar();
  
  return (
    <button 
      onClick={toggleSidebar}
      data-state={state}
      className="p-2 hover:bg-gray-100 dark:hover:bg-gray-700"
    >
      {state === 'expanded' ? 'Collapse' : 'Expand'}
    </button>
  );
}
```

### Styling

The sidebar adds the following data attributes to the root element for styling:

- `data-state="expanded"` or `data-state="collapsed"`
- `data-mobile="true"` or `data-mobile="false"`

Example CSS:

```css
[data-state="expanded"] {
  width: 16rem;
  transition: width 200ms ease;
}

[data-state="collapsed"] {
  width: 4rem;
  transition: width 200ms ease;
}

[data-mobile="true"] {
  position: fixed;
  z-index: 50;
}
```

## Keyboard Shortcuts

- `Ctrl + \` or `Cmd + \`: Toggle sidebar visibility

## Best Practices

1. **Mobile First**: Always test the sidebar on mobile devices to ensure proper behavior
2. **Performance**: For large sidebars, consider virtualizing long lists of items
3. **Accessibility**: Ensure proper ARIA attributes are set for screen readers
4. **State Persistence**: Consider persisting the sidebar state to localStorage if needed

## Troubleshooting

### Sidebar doesn't respond to keyboard shortcuts
- Ensure the sidebar or one of its children has focus
- Check for event listener conflicts

### State not updating
- Make sure you're using the context consumer or `useSidebar` hook correctly
- Verify that no intermediate components are blocking context updates

## Related Components

- `AppShell` - Main application layout wrapper
- `AppHeader` - Top navigation bar
- `NavMain` - Main navigation items
- `NavUser` - User profile section

---

For more information, refer to the component's source code at `resources/js/components/ui/sidebar.tsx`.
