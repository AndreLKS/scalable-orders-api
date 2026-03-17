<?php
public function render($request, Throwable $e)
{
    if ($request->expectsJson()) {
        return response()->json([
            'error' => true,
            'message' => $e->getMessage(),
        ], 500);
    }

    return parent::render($request, $e);
}