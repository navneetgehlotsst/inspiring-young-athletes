<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\{
  User,
  Video,
  Subscriptions,
  Plan,
  Transaction,
  VideoHistory,
  UserIncome
};
use Illuminate\Support\Carbon;

class UserIncomes extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'user_income:genrate';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'User Income';

  /**
   * Execute the console command.
   */
  public function handle()
  {
      $currentMonth = date('m');
      $namecurrentMonth = date('M');
      $currentYear = date('Y');

      // Get the previous month and year
      $previousMonth = date('m', strtotime('-1 month'));
      $namepreviousMonth = date('M', strtotime('-1 month'));
      $previousYear = date('Y', strtotime('-1 month'));

      // Fetch videos with count of videoHistory
      $videos = Video::withCount('videoHistory')
          ->get();

      // Fetch total views for the current month
      $totalViews = VideoHistory::whereYear('created_at', $currentYear)
          ->whereMonth('created_at', $currentMonth)
          ->count();

      // Fetch total income for the current month
      $income = Transaction::where('status', 'active')
          ->whereYear('created_at', $currentYear)
          ->whereMonth('created_at', $currentMonth)
          ->sum('amount');

      // Fetch users who are not 'User' and have active status
      $users = User::where('roles', '!=', 'User')
          ->where('user_status', '1')
          ->get();

      // Process user data
      foreach ($users as $user) {
          $uniqueViews = $videos->where('user_id', $user->id)->sum('video_history_count');
          $videoRevenue = 0;

          if ($totalViews != 0) {
              $athleteShare = $uniqueViews / $totalViews;
              $totalAthleteIncome = $income * env('ATHLETES_COACH');
              $videoRevenue = number_format($totalAthleteIncome * $athleteShare, 2);
          }

          // Create UserIncome record
          UserIncome::create([
              'user_id' => $user->id,
              'videorevenue' => $videoRevenue,
              'month' => $namecurrentMonth,
              'years' => $currentYear,
          ]);
      }

      // Fetch user incomes for the current month
      $userIncomes = UserIncome::where('month', $namecurrentMonth)
          ->where('years', $currentYear)
          ->get();

      // Process referral commissions
      foreach ($userIncomes as $userIncome) {
          $totalCommission = 0;
          $userReferrals = User::where('referral_by', $userIncome->user_id)->get();

          foreach ($userReferrals as $userReferral) {
              $userReferralIncome = UserIncome::where('user_id', $userReferral->id)
                  ->where('month', $namecurrentMonth)
                  ->where('years', $currentYear)
                  ->value('videorevenue');

              $commission = $userReferralIncome * env('REFERRAL');
              $totalCommission += $commission;
          }

          // Update referral revenue for the user
          $userIncome->update(['referralrevenue' => $totalCommission]);
      }
      
  }
}
