<li class="side-menus {{ Request::is('home') ? 'active' : '' }}">
    <a class="nav-link" href="/">
        <i class=" fas fa-building"></i><span>Dashboard</span>
    </a>
    <a class="nav-link" href="/roles">
        <i class=" fas fa-building"></i><span>Roles</span>
    </a>
    <a class="nav-link" href="/usuarios">
        <i class=" fas fa-building"></i><span>Usuarios</span>
    </a>
    <a class="nav-link" href="{{ route('A_clientes.index') }}">
        <i class="fas fa-building"></i><span>Clientes</span>
    </a>
    <a class="nav-link" href="{{route('categoria.index')}}">
        <i class="fas fa-tags"></i><span>Categoria de productos</span>
    </a>
    <a class="nav-link" href="{{route('productos.index')}}">
        <i class="fas fa-cubes"></i><span>Productos</span>
    </a>
    <a class="nav-link" href="/Insumos">
        <i class="fas fa-box"></i><span>Insumos</span>
    </a>
    <a class="nav-link" href="{{route('pedidos.index')}}">
        <i class="fas fa-boxes"></i><span>Pedidos</span>
    </a>
    <a class="nav-link" href="{{route('ventas.index')}}">
        <i class="fas fa-shopping-cart"></i><span>Ventas</span>
    </a>
    
    {{-- Linkeamiento a productos --}}
    
    {{-- Linkeamiento a insumos --}}
    
    
</li>
