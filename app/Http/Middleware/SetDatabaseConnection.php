<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class SetDatabaseConnection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (config('app.env') !== 'local') {
            // Extract subdomain from the host
            $host = $request->getHost();
            $hostParts = explode('.', $host) ?? [];
            $subdomain = $hostParts[0] ?? ''; // Fallback to 'default' if no subdomain

            $cacheKey = 'db_sajiloattendance_' . $subdomain;

            $dbConfig = Cache::remember($cacheKey, 60, function () use ($subdomain) {
                $response = Http::get('https://sajiloattendance.com/api/getdatabase', [
                    'subdomain' => $subdomain,
                ]);

                if ($response->successful()) {
                    return $response->json();
                }
                return null;
            });
            // dd($dbConfig);

            if (isset($dbConfig['data']) && isset($dbConfig['data']['database'])) {
                Config::set('database.connections.mysql', [
                    'driver' => 'mysql',
                    'host' => env('DB_HOST', '127.0.0.1'),
                    'port' => env('DB_PORT', '3306'),
                    'database' => $dbConfig['data']['database'],
                    'username' => 'root',
                    'password' => 'Paradise@098',
                    'charset' => 'utf8mb4',
                    'collation' => 'utf8mb4_unicode_ci',
                    'prefix' => '',
                    'strict' => true,
                    'engine' => null,
                ]);

                DB::purge('mysql');
                DB::reconnect('mysql');

                Config::set('database.default', 'mysql');
                try {
                    DB::connection()->getPdo();
                } catch (\Exception $e) {
                    return response()->json(
                        'Database Authentication Failed',
                        500
                    );
                }
            } else {
                return response()->json(
                    'Database Authentication Failed',
                    500
                );
                // return redirect('https://paradiseit.com.np')->setStatusCode(500, 'Database Connection Failed');
            }
        }

        return $next($request);
    }
}
