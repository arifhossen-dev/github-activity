<?php

declare(strict_types=1);

namespace Arifhossen\ActiveCoder;

class GitHubActivity
{
    public function __construct(private string $username)
    {
        if (!$this->validate($this->username)) {
            echo "\n⚠️ Invalid GitHub username \n";
            exit;
        }
    }

    public function getRecentActivity(): array
    {
        return ["username"=> $this->username];
    }

    public function fetchActivity(): array
    {
        $url = "https://api.github.com/users/".$this->username."/events";

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Accept: application/vnd.github.v3+json",
                "User-Agent: php"
            ],
        ]);

        $response = curl_exec($curl);

        // Check for errors
        if($error = curl_error($curl)) {
            die('Error: ' . $error);
        }

        // Get HTTP status code
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        $data = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo "\n👾 Invalid JSON response from GitHub API";
            exit(1);
        }
        
        return $data;
    }

    private function validate(string $username): bool
    {
        return preg_match('/^[a-zA-Z0-9-]{1,39}$/', $username) === 1;
    }

    /**
     * Format the activity data into human-readable messages
     */
    public function formatActivity(array $activities): array
    {
        $formatted = [];
        
        foreach ($activities as $activity) {
            $message = match ($activity['type']) {
                'PushEvent' => $this->formatPushEvent($activity),
                'CreateEvent' => $this->formatCreateEvent($activity),
                'IssuesEvent' => $this->formatIssuesEvent($activity),
                'WatchEvent' => $this->formatWatchEvent($activity),
                'ForkEvent' => $this->formatForkEvent($activity),
                default => null
            };

            if ($message !== null) {
                $formatted[] = $message;
            }
        }

        return $formatted;
    }

    private function formatPushEvent(array $event): string
    {
        $commits = count($event['payload']['commits'] ?? []);
        $repo = $event['repo']['name'];
        return sprintf('Pushed %d commit%s to %s', 
            $commits, 
            $commits === 1 ? '' : 's', 
            $repo
        );
    }

    private function formatCreateEvent(array $event): string
    {
        $ref = $event['payload']['ref'] ?? 'unknown';
        $refType = $event['payload']['ref_type'] ?? 'unknown';
        $repo = $event['repo']['name'];
        return sprintf('Created %s "%s" in %s', $refType, $ref, $repo);
    }

    private function formatIssuesEvent(array $event): string
    {
        $action = $event['payload']['action'] ?? 'unknown';
        $repo = $event['repo']['name'];
        $issue = $event['payload']['issue']['number'] ?? 'unknown';
        return sprintf('%s issue #%s in %s', 
            ucfirst($action), 
            $issue, 
            $repo
        );
    }

    private function formatWatchEvent(array $event): string
    {
        $repo = $event['repo']['name'];
        return sprintf('Starred %s', $repo);
    }

    private function formatForkEvent(array $event): string
    {
        $repo = $event['repo']['name'];
        return sprintf('Forked %s', $repo);
    }
}