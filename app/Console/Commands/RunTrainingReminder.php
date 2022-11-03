<?php

namespace App\Console\Commands;

use App\Mail\TrainingSending;
use App\Models\Recipient;
use App\Models\Training;
use App\Models\TrainingStatistic;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Repositories\CompanyRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RunTrainingReminder extends Command{
	/**
	 * The name and signature of the console command.
	 * @var string
	 */
	protected $signature = 'training_reminder:run';
	
	/**
	 * The console command description.
	 * @var string
	 */
	protected $description = 'Run for checking training remainder';
	

	/**
	 * Create a new command instance.
	 * @return void
	 */
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * Execute the console command.
	 * @return mixed
	 */
	public function handle(){
		Log::stack(['cron'])->debug(__CLASS__.'::'.__FUNCTION__.' - RUN');

		$statistics = $this->getTrainingStatisticsData();

		#$recipient = Recipient::


		#Log::stack(['cron'])->debug('Companies Count = '.$companies_count);

		$statistics->each(function($statistic){
			Log::stack(['cron'])->debug('Statistic ID = '.$statistic->id.', '.$statistic->notify_training);
			$recipient = $this->getRecipient($statistic);
			$training = $this->getTraining($statistic);
			$this->send($recipient, $training);
		});
		
		Log::stack(['cron'])->debug('------------------------------------------------------------');
	}

	private function getTrainingStatisticsData(){
		Log::stack(['cron'])->debug(__FUNCTION__);

		$query = TrainingStatistic::query();

		$query->where(['is_finish' => 0]);
		$query->whereNotNull('notify_training');
		$query->whereDate('notify_training', '<=', Carbon::now());

		$statistics = $query->get();

		Log::stack(['cron'])->debug($statistics->toArray());

		return $statistics;
	}

	private function getRecipient($statistic){
		Log::stack(['cron'])->debug(__FUNCTION__);

		$recipient = Recipient::whereHas('trainings', function($q) use ($statistic){
			$q->where('recipient_id', $statistic->recipient_id);
			$q->where('code', $statistic->code);
		})->first();

		Log::stack(['cron'])->debug($recipient->toArray());

		return $recipient;
	}

	private function getTraining($statistic){
		Log::stack(['cron'])->debug(__FUNCTION__);

		$training = Training::whereHas('recipients', function($q) use ($statistic){
			$q->where('code', $statistic->code);
		})->first();

		Log::stack(['cron'])->debug($training->toArray());

		return $training;
	}

	private function makeTrainingUrl($recipient, $training){
		if(!$training){
			return false;
		}

		$trainingWithPivot = $recipient->trainings()->find($training->id);
		$domain = env('APP_URL');
		if(empty($domain)){
			$domain = 'https://phishmanager.net';
		}
		$href = $domain.'/tng/'.$trainingWithPivot->pivot->code;

		return $href;
	}

	private function send($recipient, $training){
		$objDemo = new \stdClass();

		$objDemo->recipient = $recipient;
		$objDemo->url = $this->makeTrainingUrl($recipient, $training);
		$objDemo->template = $training->getTemplateByType('remind');

		Mail::to($recipient->email)->send(new TrainingSending($objDemo));
	}

}
