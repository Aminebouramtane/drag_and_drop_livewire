<div class="container" style="margin-top: 80px">
    <div class="row">
        <div class="col-md-6">
            <div class="list-container p-3 border rounded shadow">
                <h2>List 1</h2>
                <ul id="list1" class="sortable-list list-unstyled" wire:sortable="moveItem('list1', $index)" wire:sortable-group="list1">
                    @foreach ($list1 as $index => $item)
                        <li class="sortable-item" wire:sortable.item="{{ $index }}" wire:key="list1-{{ $item->id }}">
                            {{ $item->name }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="list-container p-3 border rounded shadow">
                <h2>List 2</h2>
                <ul id="list2" class="sortable-list list-unstyled" wire:sortable="moveItem('list2', $index)" wire:sortable-group="list2">
                    @foreach ($list2 as $index => $item)
                        <li class="sortable-item" wire:sortable.item="{{ $index }}" wire:key="list2-{{ $item->id }}">
                            {{ $item->name }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>



<script>
    interact('.sortable-list li')
        .draggable({
            inertia: true,
            modifiers: [
                interact.modifiers.restrictRect({
                    restriction: 'parent',
                    endOnly: true,
                })
            ],
            listeners: {
                start(event) {
                    event.target.classList.add('dragging');
                },
                move(event) {
                    const target = event.target;
                    const x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
                    const y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

                    target.style.transform = `translate(${x}px, ${y}px)`;

                    target.setAttribute('data-x', x);
                    target.setAttribute('data-y', y);
                },
                end(event) {
                    event.target.classList.remove('dragging');
                    event.target.style.transform = '';
                    const listId = event.target.parentNode.id;
                    const itemId = event.target.getAttribute('wire:sortable.item');

                    if (listId === 'list1') {
                        @this.call('moveItem', 'list1', itemId);
                    } else if (listId === 'list2') {
                        @this.call('moveItem', 'list2', itemId);
                    }
                }
            }
        });
</script>
