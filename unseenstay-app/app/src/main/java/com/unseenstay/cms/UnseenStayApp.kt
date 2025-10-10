package com.unseenstay.cms

import android.app.Application
import dagger.hilt.android.HiltAndroidApp

@HiltAndroidApp
class UnseenStayApp : Application() {
    override fun onCreate() {
        super.onCreate()
        // Initialize any app-wide components here
    }
}
