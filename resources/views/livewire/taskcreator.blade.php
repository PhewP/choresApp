
<div style="margin-bottom: 30px;">
    <div class="d-flex flex-row justify-content-between align-items-center p-2 bg-white border">
        <div class="feed-text px-2">
            <h6 class="mt-2">Crear tarea</h6>
        </div>
      <i id="plusButton" class="fa fa-plus" role="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
      </i>
    </div>
    <div class="collapse" id="collapseExample">
    
      <div>
          <div class="card card-body">
            Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
        
          <div class="mt-3 mr-3">
              <x-jet-button wire:click="createTask">Crear</x-jet-button>
          </div>
          </div>
      </div>
    </div>
</div>

