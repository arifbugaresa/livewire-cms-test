<?php

namespace App\Http\Livewire;

use App\Models\Page;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Pages extends Component
{
    public $modalFormVisible = false;
    public $slug;
    public $title;
    public $content;
    
    /**
     * The validation rules.
     *
     * @return void
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'slug' => ['required', Rule::unique('pages', 'slug')],
            'content' => 'required'

        ];
    }
    
    /**
     * Runs everytime slug update.
     *
     * @param  mixed $value
     * @return void
     */
    public function updatedTitle($value) 
    {
        $this->generateSlug($value);
    }
    
    /**
     * The create function.
     *
     * @return void
     */
    public function create()
    {
        $this->validate();
        Page::create($this->modelData());
        $this->modalFormVisible = false;
        $this->resetVars();
    }
    
    
    /**
     * show the form modal of the create function.
     *
     * @return void
     */
    public function createShowModal()
    {
        $this->modalFormVisible = true;
        
    }
    
    /**
     * Reset all variable
     * to null.
     *
     * @return void
     */
    public function resetVars()
    {
        $this->title = null;
        $this->slug = null;
        $this->content = null;
    }
    
    /**
     * Generate slug base of
     * the title.
     *
     * @param  mixed $value
     * @return void
     */
    /**
     * The data for the model mapped
     * in this component.
     *
     * @return void
     */
    public function modelData()
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content
        ];
    }
    
    /**
     * the livewire render function.
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.pages');
    }
}
