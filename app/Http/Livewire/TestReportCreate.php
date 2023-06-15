<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Patient;
use App\Models\Test;
use App\Models\Testreport;
use Livewire\Component;

class TestReportCreate extends Component
{
    public $patient;
    public $categories;
    public $tests;
    public $categoryId;
  
 
    public function mount(Patient $patient)
    {
        $this->patient = $patient;
        $this->tests = Test::get();
        $this->categories = Category::get();
    }
    public function render()
    {
        
        return view('livewire.test-report-create');
    }
}
