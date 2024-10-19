<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Patient;
use App\Models\Report;
use App\Models\Test;
use App\Models\Testreport;
use Livewire\Component;

class TestReportCreate extends Component
{
    public $patient;
    public $categories;
    public $subCategories = [];
    public $category;
    public $subCategory;

    public $tests;
    public $testList = [];
    public $categoryId;
    public $subCategoryId;

    public $removeTestIds = [];
    public $report;

    public function mount(Patient $patient, Report $report = null)
    {
        $this->patient = $patient;

        $this->categories = Category::with(['childCategories.childCategories'])
            ->where('parent_id', null)
            ->orderBy('name')
            ->get();
        if ($report) {
            $testReports = $report->testreport()->get();
            foreach ($testReports as $key => $testReport) {
                $this->testList[] = [
                    'test_id' => $testReport->test_id,
                    'parent_id' => $testReport->parent_id,
                    'category_id' => $testReport->category_id,
                    'sub_category_id' => $testReport->sub_category_id,
                    'category_name' => $testReport->category->name,
                    'sub_category_name' => $testReport->subCategory->name,
                    'name' => $testReport->test->name,
                    'unit' => $testReport->test->unit,
                    'range' => $testReport->test->range,
                    'result' => $testReport->result,
                    'method' => $testReport->method,
                    'status' => $testReport->status,
                    'level' => 1,
                ];
            }
        }
    }
    public function updatedCategoryId($categoryId)
    {
        $this->category = Category::find($categoryId);

        $this->subCategories = $this->category->childCategories()->orderBy('name')->get();
    }
    public function loadTests()
    {
        $this->subCategory = Category::with('test', 'test.childTests')->find($this->subCategoryId);

        $this->tests = $this->subCategory->test()->with('childTests')->where('parent_id', null)->get();
        foreach ($this->tests as $key => $test) {
            $this->testList[] = [
                'test_id' => $test->id,
                'parent_id' => $test->parent_id,
                'category_id' => $this->categoryId,
                'sub_category_id' => $this->subCategoryId,
                'category_name' => $this->category->name,
                'sub_category_name' => $this->subCategory->name,
                'name' => $test->name,
                'unit' => $test->unit,
                'range' => $test->range,
                'result' => null,
                'method' => null,
                'status' => 0,
                'level' => 1,
            ];
            if ($test->childTests) {
                foreach ($test->childTests as $childTest) {
                    $this->testList[] = [
                        'test_id' => $childTest->id,
                        'parent_id' => $childTest->parent_id,
                        'category_id' => $this->categoryId,
                        'sub_category_id' => $this->subCategoryId,
                        'category_name' => $this->category->name,
                        'sub_category_name' => $this->subCategory->name,
                        'name' => $childTest->name,
                        'unit' => $childTest->unit,
                        'range' => $childTest->range,
                        'result' => null,
                        'method' => null,
                        'status' => 0,
                        'level' => 2,
                    ];
                }
            }
        }
    }
    public function removeTest($index)
    {
        unset($this->testList[$index]);
        $this->testList = array_values($this->testList);
    }
    public function render()
    {
        return view('livewire.test-report-create');
    }
}
